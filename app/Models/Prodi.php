<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model {

  // protected $primaryKey = 'kode_program_studi';
  // public $incrementing = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */

   
  protected $fillable = [
    'nama'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var string[]
   */
  protected $hidden = [];

  public function mahasiswas(){
    return $this->hasMany(Mahasiswa::class, 'prodiId');
  }
}