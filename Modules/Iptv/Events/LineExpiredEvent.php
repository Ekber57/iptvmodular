<?php
namespace Modules\Iptv\Events;

use Modules\Iptv\Models\Line;

class LineExpiredEvent {
    public $line;
    public function __construct(Line $line) {
        $this->line = $line;
    }
}
