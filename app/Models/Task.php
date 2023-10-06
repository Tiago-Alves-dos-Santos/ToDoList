<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    /*****************************ESCOPOS********************************/
    public function scopeFilterStatusAndDelete($query, Object $options)
    {
        if ($options->deleted) {
            $query->withTrashed();
        }
        $status = [
            $options->pending ? 'pending' : null,
            $options->completed ? 'completed' : null,
        ];
        $query->whereIn('status', $status);
        return $query;
    }
    public function scopePending($query)
    {
        return $query->where('status', TaskStatus::PENDING->value);
    }
    public function scopeCompleted($query)
    {
        return $query->where('status', TaskStatus::COMPLETED->value);
    }

    /*****************************METODOS********************************/
    /**
     * Metodo que retorna status da tarefa, ainda não possui suporte a outros idiomas
     *
     * @return string
     */
    public function getStatusYourLanguage(): string
    {
        //default ptbr, substirtuir por '__('idioma_json')' caso necessario mais de um idioma
        $language = [
            TaskStatus::COMPLETED->value => 'concluída',
            TaskStatus::PENDING->value => 'pendente'
        ];

        return $language[$this->status];
    }
    /**
     * Verifica se a tarefa esta completa
     *
     * @return boolean
     */
    public function isCompleted(): bool
    {
        return $this->status == TaskStatus::COMPLETED->value ? true : false;
    }
}
