<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model {

  protected $primaryKey = 'nim';
  public $incrementing = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'nim', 'nama', 'angkatan', 'prodiId', 'password', 'token'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var string[]
   */
  protected $hidden = [
    'password'
  ];
  
  public function prodi(){
    return $this->belongsTo(Prodi::class, 'prodiId');
  }

  public function matakuliah(){
    return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'nim', 'mkId');
  }
}