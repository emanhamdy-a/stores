<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
  use HasFactory;
  protected $table = 'photos';
  protected $fillable = [
  	'filename',
  	'photoable_id',
  	'photoable_type'
  ];
  public function Pictureable() {
    return $this->morphTo();
  }
}
