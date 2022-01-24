<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    
    public function details(): HasMany
    {
        return $this->hasMany(EventDetail::class);
    }

    public function countSum($id, $option, $fullBank = 'hide')
    {
        $event = Event::where('id', $id)->with(['details' => function($query) use($option) {
            $query->where('type',$option);
        }])->first();
        $sum = array();

        if($fullBank == 'show') {
            foreach($event->details as $item) {
                $sum[] = ($item->bank * $item->odds);
            }
            return (array_sum($sum));
        }
        foreach($event->details as $item){
           if($option == 'win') {
                $sum[] = ($item->bank * $item->odds) - $item->bank;
           }else {
                $sum[] = $item->bank;
           }
        }

        return (array_sum($sum));
    }

    public function countBet($id, $option)
    {
        $event = Event::where('id', $id)->withCount(['details' => function($query) use($option) {
            $query->where('type',$option);
        }])->first();
        return ($event->details_count);
    }
}
