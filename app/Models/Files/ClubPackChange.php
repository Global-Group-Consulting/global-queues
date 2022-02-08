<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ClubPackChange extends Model {
  use HasFactory;
  
  protected $fillable = [
    "firstName",
    "lastName",
    "gender",
    "fiscalCode",
    "birthProvince",
    "birthCity",
    "birthDate",
    "legalRepresentativeProvince",
    "legalRepresentativeZip",
    "legalRepresentativeCity",
    "legalRepresentativeAddress",
    "phone",
    "email",
    "docNumber",
    "referenceAgent",
    "mobile",
    "packCost",
    "currentYear",
    "currentDate",
  ];
  
  public function setFirstNameAttribute($value) {
    $this->attributes['firstName'] = Str::ucfirst($value ?? '');
  }
  
  public function setLastNameAttribute($value) {
    $this->attributes['lastName'] = Str::ucfirst($value ?? '');
  }
  
  public function setGenderAttribute($value) {
    $this->attributes['gender'] = Str::lower($value ?? '');
  }
  
  public function setFiscalCodeAttribute($value) {
    $this->attributes['fiscalCode'] = Str::upper($value ?? '');
  }
  
  public function setBirthProvinceAttribute($value) {
    $this->attributes["birthProvince"] = Str::upper($value ?? '');
  }
  
  public function setBirthCityAttribute($value) {
    $this->attributes["birthCity"] = Str::ucfirst($value ?? '');
  }
  
  public function setBirthDateAttribute($value) {
    $this->attributes["birthDate"] = Date::createFromDate($value)->format("d/m/Y");
  }
  
  public function setLegalRepresentativeProvinceAttribute($value) {
    $this->attributes["legalRepresentativeProvince"] = $value;
  }
  
  public function setLegalRepresentativeZipAttribute($value) {
    $this->attributes["legalRepresentativeZip"] = $value;
  }
  
  public function setLegalRepresentativeCityAttribute($value) {
    $this->attributes["legalRepresentativeCity"] = $value;
  }
  
  public function setLegalRepresentativeAddressAttribute($value) {
    $this->attributes["legalRepresentativeAddress"] = $value;
  }
  
  public function setPhoneAttribute($value) {
    $this->attributes["phone"] = $value;
  }
  
  public function setEmailAttribute($value) {
    $this->attributes["email"] = $value;
  }
  
  public function setDocNumberAttribute($value) {
    $this->attributes["docNumber"] = $value;
  }
  
  public function setReferenceAgentAttribute($value) {
    $this->attributes["referenceAgent"] = $value;
  }
  
  public function setMobileAttribute($value) {
    $this->attributes["mobile"] = $value;
  }
  
  public function setPackCostAttribute($value) {
    $this->attributes["packCost"] = number_format($value, 2, ",", ".");
  }
  
  public function setCurrentYearAttribute($value) {
    $this->attributes["currentYear"] = $value;
  }
  
  public function setCurrentDateAttribute($value) {
    $this->attributes["currentDate"] = Date::createFromDate($value)->format("d/m/Y");;
  }
}
