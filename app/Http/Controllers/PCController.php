<?php

namespace App\Http\Controllers;

use App\Models\PC;
use App\Models\CPU;
use App\Models\GPU;
use App\Models\Motherboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PCController extends Controller
{
    public function index()
    {
        // get all components
        $data['cpu'] = CPU::orderBy('CPU', 'ASC')->get();
        $data['gpu'] = GPU::orderBy('GPU', 'ASC')->get();
        $data['motherboard'] = Motherboard::orderBy('Motherboard', 'ASC')->get();

        return view('welcome')->with('data', $data);
    }

    public function predict(Request $request)
    {
        $inputchecks = GPU::where('GPU', 'like', strtr($request->input('gpu'), array('(' => '%', ')' => '%')))->count();
        $inputchecks += CPU::where('CPU', 'like', strtr($request->input('selectedCPU'), array('(' => '%', ')' => '%')))->count();
        $inputchecks += Motherboard::where('Motherboard', 'like', strtr($request->input('motherboard'), array('(' => '%', ')' => '%')))->count();

        if ($inputchecks >= 3) {
            $body['CPU'] = $request->input('selectedCPU');
            $body['Motherboard'] = $request->input('motherboard');
            $body['GPU'] = $request->input('gpu');
            $body['KEY'] = "3163-a50e-9abc-49be-94c2-4e8a-e480-cbd9";

            $response = Http::post(env('PYTHON_API').'predict', [
                json_encode($body)
            ]);

            $bodyFPS['Score'] = $response->body();

            $csgo = Http::post(env('PYTHON_API').'csgo', [
                json_encode($bodyFPS)
            ]);

            $overwatch = Http::post(env('PYTHON_API').'overwatch', [
                json_encode($bodyFPS)
            ]);

            $pubg = Http::post(env('PYTHON_API').'pubg', [
                json_encode($bodyFPS)
            ]);

            $fortnite = Http::post(env('PYTHON_API').'fortnite', [
                json_encode($bodyFPS)
            ]);

            $gtav = Http::post(env('PYTHON_API').'gtav', [
                json_encode($bodyFPS)
            ]);

            // get all components
            $data['cpu'] = CPU::orderBy('CPU', 'ASC')->get();
            $data['gpu'] = GPU::orderBy('GPU', 'ASC')->get();
            $data['motherboard'] = Motherboard::orderBy('Motherboard', 'ASC')->get();

            return view('welcome')->with('response', $response->body())->with('data', $data)->with('csgo', $csgo->body())->with('overwatch', $overwatch->body())->with('pubg', $pubg->body())->with('fortnite', $fortnite->body())->with('gtav', $gtav->body())->with('request', $request);
        }

    }

    public function suggestion(Request $request)
    {
        $currentCpu = $request->input('suggestionCpu');
        $currentGpu = $request->input('suggestionGpu');
        $score = $request->input('scoreResponse');

        $currentSocket = CPU::where('CPU', '=', $currentCpu)->first()['Socket'];

        $gpus = ['GeForce RTX 3090  (GA102)', 'GeForce RTX 3080  (GA102)', 'GeForce RTX 3070  (GA104)', 'GeForce GTX 1660 Ti', 'GeForce GTX 1660 SUPER  (TU116)', ' Radeon RX 5700 XT  (Navi 10)', 'Radeon VII  (Vega 20)', 'Radeon RX 5600 XT  (Navi 10)'];
        $cpusSameSocket = [];

        $cpus = CPU::orderBy('CPU', 'ASC')->get();

        foreach ($cpus as $cpu)
        {
            if ($currentSocket == $cpu['Socket'] && $currentCpu != $cpu['CPU'])
                array_push($cpusSameSocket, $cpu['CPU']);
        }

        $body['currentCpu'] = $currentCpu;
        $body['suggestedCpus'] = $cpusSameSocket;
        $body['Motherboard'] = $request->input('suggestionMotherboard');
        $body['currentGpu'] = $currentGpu;
        $body['suggestedGpus'] = $gpus;
        $body['currentScore'] = $score;

        $response = Http::post(env('PYTHON_API').'suggest', [
            json_encode($body)
        ]);
        $suggestionsCpu = json_decode($response->body())[0];
        $suggestionsGpu = json_decode($response->body())[1];

        // get all components
        $data['cpu'] = CPU::orderBy('CPU', 'ASC')->get();
        $data['gpu'] = GPU::orderBy('GPU', 'ASC')->get();
        $data['motherboard'] = Motherboard::orderBy('Motherboard', 'ASC')->get();

        return view('welcome')->with('data', $data)->with("suggestionsCpu", $suggestionsCpu)->with("suggestionsGpu", $suggestionsGpu);
    }


}
