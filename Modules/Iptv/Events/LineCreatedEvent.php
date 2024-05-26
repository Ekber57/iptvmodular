<?php
namespace Modules\Iptv\Events;

use Modules\Iptv\Models\Line;

class LineCreatedEvent {
    public $line;
    public function __construct(Line $line) {
        $this->line = $line;
    }
}


?>