<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbrayuan extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['NAMA','NOKP','NAMA_SR1','NAMA_SR2','KOD_SR1','KOD_SR2','ALIRAN_SR1','ALIRAN_SR2','SEDIA','created_at','updated_at'];

}
