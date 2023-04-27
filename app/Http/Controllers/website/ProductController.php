<?php

namespace App\Http\Controllers\website;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index',compact('products'))->with(request()->input('page'));

        // using API
        // $response = Http::get('http://your-api-endpoint.com/products');
        // $products = $response->json();

        // return view('products.index',compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'detail'=>'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success','Product created successfully');


        //for calling API
        // // Retrieve the input data from the request body
        // $inputData = $request->all();

        // // Call your API to store the data
        // $response = $this->callApi('POST', 'https://example.com/api/products', $inputData);

        // // Check if the API call was successful
        // if ($response->getStatusCode() == 200) {
        //     $responseData = json_decode($response->getBody(), true);
        //     // Return a JSON response with the results of the API call
        //     return response()->json(['success' => true, 'data' => $responseData]);
        // } else {
        //     // Return a JSON response with the error message
        //     return response()->json(['success' => false, 'error' => 'Error storing product'], $response->getStatusCode());
        // }
    }

    // // Helper function to call the API
    // private function callApi($method, $url, $data = [])
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $options = [
    //         'headers' => [
    //             'Accept' => 'application/json',
    //             'Content-Type' => 'application/json',
    //         ],
    //         'json' => $data,
    //     ];
    //     $response = $client->request($method, $url, $options);
    //     return $response;
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show',compact('product'));

        // using API
        // $response = Http::get('https://example.com/api/products/'.$id);
        // $product = $response->json();
        // return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit',compact('product'));

        // using API
        // $response = Http::get('https://example.com/api/products/'.$id);
        // $product = $response->json();
        // return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'detail'=>'required'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                         ->with('success','Product updated successfully');

        //using API
        // $response = Http::put('http://example.com/api/products/' . $product->id, $request->all());
        
        // if ($response->status() === 200) {
        //     return redirect()->route('products.index')
        //                         ->with('success', 'Product updated successfully');
        // } else {
        //     // Handle the error
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');

        // using API
        // $response = Http::delete('http://example.com/api/products/' . $id);

        // if ($response->getStatusCode() == 204) {
        //     // Product deleted successfully
        // } else {
        //     // Handle error response
        // }
    }

}
