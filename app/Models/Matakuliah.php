<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model {
  // protected $primaryKey = 'kode_mata_kuliah';
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
    return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_mata_kuliah', 'id', 'nim');
  }
}