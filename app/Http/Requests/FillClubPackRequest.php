<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/*[
      "firstName"                   => "Mario",
      "lastName"                    => "Rossi",
      "gender"                      => "f",
      "fiscalCode"                  => "lcefrn89",
      "birthProvince"               => "VI",
      "birthCity"                   => "Schio",
      "birthDate"                   => "20/02/1989",
      "legalRepresentativeProvince" => "RO",
      "legalRepresentativeZip"      => "78614",
      "legalRepresentativeCity"     => "Roma",
      "legalRepresentativeAddress"  => "Via Roma 129",
      "phone"                       => "0445570297",
      "email"                       => "flroain.leica@gmail.com",
      "docNumber"                   => "aabb221ss",
      "referenceAgent"              => "Francesco tripodi",
      "mobile"                      => "33892182653",
      "packCost"                    => "250,87",
      "currentYear"                 => "2022",
      "currentDate"                 => "08/02/2022"
    ]*/

class FillClubPackRequest {
  
  
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public static function rules(): array {
    return [
      "firstName"                   => "required|string",
      "lastName"                    => "required|string",
      "gender"                      => "nullable|in:f,m",
      "fiscalCode"                  => "required|string",
      "birthProvince"               => "nullable|string",
      "birthCity"                   => "nullable|string",
      "birthDate"                   => "nullable|date",
      "legalRepresentativeProvince" => "nullable|string",
      "legalRepresentativeZip"      => "nullable|string",
      "legalRepresentativeCity"     => "nullable|string",
      "legalRepresentativeAddress"  => "nullable|string",
      "phone"                       => "nullable|string",
      "email"                       => "required|email",
      "docNumber"                   => "nullable|string",
      "referenceAgent"              => "nullable|string",
      "mobile"                      => "required|string",
      "packCost"                    => "required|numeric",
      "currentYear"                 => "required|integer|min:" . date('Y'),
      "currentDate"                 => "required|date"
    ];
  }
}
