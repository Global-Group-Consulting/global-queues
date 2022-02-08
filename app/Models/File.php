<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property string fileUrl
 * @property string extname
 * @property string clientName
 * @property string fieldName
 * @property string type
 * @property string subtype
 * @property int    size
 */
class File extends Model {
  use HasFactory;
  
  /*
  {"_id":{"$oid":"5fd9caf99154ff003e8f63f1"},
  "fileUrl":"https://globalgroupstaging.s3.eu-central-1.amazonaws.com/5fd9caf99154ff003e8f63f1",
  "userId":{"$oid":"5fd9c81f9154ff003e8f63cf"},
  "loadedBy":{"$oid":"5fd9c81f9154ff003e8f63cf"},
  "clientName":"contratto-ggc-brux_marrone.pdf",
  "extname":"pdf",
  "fileName":"null",
  "fieldName":"contractDoc",
  "type":"application",
  "subtype":"pdf",
  "created_at":{"$date":"2020-12-16T08:53:14.279Z"},
  "updated_at":{"$date":"2020-12-16T08:53:14.279Z"}}
  */
  
  protected $fillable = ["fileUrl", "extname", "clientName", "fieldName", "type", "subtype", "size"];
  
  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['mimetype', "fileName", "id", "server"];
  
  public function getMimetypeAttribute() {
    return $this["type"] . "/" . $this["subtype"];
  }
  
  public function getFileNameAttribute() {
    return $this["clientName"];
  }
  
  public function getServerAttribute() {
    return "files";
  }
}
