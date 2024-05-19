<?php
namespace Modules\Iptv\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Iptv\App\Actions\LineAction;
use Modules\Iptv\App\Http\Requests\LineCreateRequest;


class LineController extends Controller
{
    public function show(LineAction  $lineAction)
    {
        
        return view("lines", [
            "lines" => $lineAction->getLines(Auth::user()),
        ]);
    }
    public function create(LineAction $lineAction)
    {

        return view("createline", [
            "packages" => $lineAction->getPackages(),
        ]);
    }
    public function store(LineAction $lineAction, LineCreateRequest $lineCreateRequest)
    {

        // print_r($lineCreateRequest->bouquets_selected);
        return $lineAction->addLine($lineCreateRequest);
    }
}
