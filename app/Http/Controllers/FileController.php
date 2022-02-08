<?php

namespace App\Http\Controllers;

use App\Http\Requests\FillClubPackRequest;
use App\Http\Requests\FillRequest;
use App\Models\File;
use App\Models\Files\ClubPackChange;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use mikehaertl\pdftk\Pdf;

class FileController extends Controller {
  private $templatesMap = [
    "club_pack_change" => [
      "validator" => FillClubPackRequest::class,
      "model"     => ClubPackChange::class
    ]
  ];
  
  function show(File $file) {
    return  Storage::response($file["fileUrl"]);
  }
  
  function fill(FillRequest $request, $returnAsFile = false) {
    $validatedData = $request->validated();
    $template      = $validatedData["template"];
    $pdfData       = $validatedData["data"];
    $tmplPath      = "pdf_templates/$template.pdf";
    
    if ( !Storage::disk("local")->exists($tmplPath)) {
      abort(404, "Unknown template");
    }
    
    // create tmp folder fot storing temp files
    Storage::disk("local")->makeDirectory("tmp");
    
    $pdf = new Pdf(Storage::disk("local")->path($tmplPath));
    
    /*  $data = $pdf->getDataFields();
      return $data;*/
    
    if (key_exists($template, $this->templatesMap)) {
      // validate data
      $pdfData = Validator::make($pdfData, $this->templatesMap[$template]["validator"]::rules())->validate();
      // parse and cast data through the model
      $pdfData = (new $this->templatesMap[$template]["model"]($pdfData))->toArray();
    }
    
    $result = $pdf->fillForm($pdfData)
      ->flatten()
      ->execute();
    
    if ($result === false) {
      return abort(500, $pdf->getError());
    }
    
    $content = file_get_contents((string) $pdf->getTmpFile());
    
    if ($returnAsFile) {
      return $content;
    }
    
    return response($content)
      ->withHeaders([
        'Content-Type' => "application/pdf",
      ]);
  }
  
  function fillAndStore(FillRequest $request) {
    $validatedData = $request->validated();
    $fileContent   = $this->fill($request);
    
    $userName = Str::lower($validatedData["data"]["firstName"] . "_" . $validatedData["data"]["lastName"]);
    $fileName = $validatedData["template"] . "_" . $userName . "_" . Str::uuid() . ".pdf";
    $filePath = "/filledDocs/$fileName";
    
    Storage::put($filePath, $fileContent);
    
    return File::create([
      "fileUrl"    => $filePath,
      "clientName" => $fileName,
      "extname"    => "pdf",
      "type"       => "application",
      "subtype"    => "pdf",
      "size"       => Storage::size($filePath)
    ]);
  }
}
