<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use betterapp\LaravelDbEncrypter\Traits\EncryptableDbAttribute;

class Message extends Model
{
    use EncryptableDbAttribute;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['addressee_id', 'text', 'gif_url', 'author_id', 'image_url', 'text_color', 'background_color'];

    protected $encryptable = ['text'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function createdDate()
    {   
        $date_format = 'd. M y';

        $created = Carbon::parse($this->created_at);
        $today = Carbon::parse(date($date_format));
        
        $different_days = $created->diffInDays($today);

        if ($different_days == 0) {
            return 'today';
        } else if ($different_days == 1) {
            return 'yesterday';
        } else if ($different_days == 7) {
            return 'a week ago';
        }

        return $created->format($date_format);
    }
}
