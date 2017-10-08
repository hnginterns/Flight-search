<?php namespace App\Http\Controllers;

use App\Flight;
use App\Transformers\FlightTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;


class FlightController extends ApiController {
  
    protected $validationRules = [
        'city'         => 'required',
        'IATA'         => 'required',
        'airport'      => 'required',
        'origin'       => 'required',
        'destination'  => 'required',
    ];
  
    protected $flight;
    
    function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }
    
    /**
     * @param $flightId
     * @param Manager $fractal
     * @param flightTransformer $flightTransformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Manager $fractal, FlightTransformer $flightTransformer)
    {
        $flight = $this->flight->get();
        $item = new Item($flight, $flightTransformer);
        $data = $fractal->createData($item)->toArray();
        return $this->respond($data);
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules);
        $this->flight->city = $request->get('city');
        $this->flight->IATA = $request->get('IATA');
        $this->flight->airport = $request->get('airport');
        $this->flight->origin = $request->get('origin');
        $this->flight->destination = $request->get('destination');
        $this->flight->save();
        return $this->respondCreated('Flight was created');
    }
    
    /**
     * @param $flightId
     * @param Manager $fractal
     * @param FlightTransformer $flightTransformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($flightId, Manager $fractal, FlightTransformer $flightTransformer)
    {
        $flight = $this->flight->findOrFail($flightId);
        $item = new Item($flight, $flightTransformer);
        $data = $fractal->createData($item)->toArray();
        return $this->respond($data);
    }
    /**
     * @param $flightId
     * @param Request $request
     * @return mixed
     */
    public function update($flightId, Request $request)
    {
        $flight = $this->flight->findOrFail($flightId);
        $this->validate($request, $this->validationRules);
        $flight->city = $request->get('city');
        $flight->IATA = $request->get('IATA');
        $flight->airport = $request->get('airport');
        $flight->origin = $request->get('origin');
        $flight->destination = $request->get('destination');
        $flight->save();
        return $this->respondCreated('Flight was updated');
    }
    /**
     * @param $flightId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($flightId)
    {
        $flight = $this->flight->findOrFail($flightId);
        $flight->delete();
        return $this->respondOk('Flight was deleted');
    }
}