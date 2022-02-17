<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobListRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
        return true;
  }
  
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      "title"             => "required",
      "description"       => "required",
      "class"             => "required|unique:App\Models\JobList,class",
      "queueName"         => "required",
      "payloadKey"        => "nullable|string",
      "payloadValidation" => "nullable|string",
      "apiUrl"            => "nullable|string",
      "apiMethod"         => "nullable|string",
      "apiHeaders"        => "nullable|string",
      "authType"          => "nullable|string",
      "authUsername"      => "nullable|string",
      "authPassword"      => "nullable|string",
    ];
  }
}
