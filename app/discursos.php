<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Str;

class discursos extends Model
{
    protected $table = 'discursos';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['id','idbarrio','fecha','hora','nombre','tema','duracion','lugar','realizado','lider1','lider2','lider3','user_id'];

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }

    public function scopeByUser($query, $userid){
        $query->where('user_id', $userid);
    }

    public function getNombreCapAttribute(){
        $nombre=Str::title($this->nombre);
        return $nombre;
    }
    public function getTemaCapAttribute(){
        $tema=Str::title($this->tema);
        return $tema;
    }
    public function getLugarCapAttribute(){
        $lugar=Str::title($this->lugar);
        return $lugar;
    }
    public function getFechadmaAttribute(){
        $fecha=Carbon::createFromFormat('Y-m-d',$this->fecha);
        return $fecha->format('l d F Y');
    }

    public function getHoraHMAttribute(){
        $horaarray=explode(':',$this->hora);
        $hora=Carbon::createFromTime($horaarray[0],$horaarray[1],$horaarray[2]);
        return $hora->format('g:i a');

    }

    public function getrealizadostrAttribute(){
        if($this->realizado==true){
            return "Si";
        }
        else{
            return "No";
        }
    }

    public function getnombrearchivoAttribute(){
        $nombre="Discurso_".$this->id."_".$this->nombre;
        $nombre=str_replace(' ','_',$nombre);
        return $nombre;
    }

    public function barrio(){
        return $this->hasMany('SIU\barrios', 'id', 'idbarrio');
    }

    public function lider1datos(){
        return $this->hasOne('SIU\lideres', 'id', 'lider1')->withTrashed();
    }
    public function lider2datos(){
        return $this->hasOne('SIU\lideres', 'id', 'lider2')->withTrashed();
    }
    public function lider3datos(){
        return $this->hasOne('SIU\lideres', 'id', 'lider3')->withTrashed();
    }
}
