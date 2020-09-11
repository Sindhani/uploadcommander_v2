<?php

	namespace App\Http\Controllers\Customer;

	use App\Models\Caption;
	use App\Http\Controllers\Controller;
    use Auth;
    use Illuminate\Http\Request;

	class CaptionController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function index()
		{
//		    dd(Caption::where('customer_id', '=',Auth::guard('customers')->id())->first());
			return view('customer.captions.index')->with('captions', Caption::where('customer_id', '=',
                Auth::guard('customers')->id())->get());
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('customer.captions.create');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{

			Caption::create(
			    [
			        'caption_name' => $request->caption_name,
                    'caption_content' => $request->caption_content,
                    'customer_id' => Auth::guard('customers')->id()
                ]);


			return redirect()->to('customer/captions')->withSuccess('New Caption Caption added successfully');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function show($id)
		{
			return view('customer.captions.show')->with(Caption::find($id)->get);
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function edit($id)
		{
			return view('customer.captions.edit')->with('caption', Caption::where('id', '=', $id)->first());
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int                      $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
			Caption::find($id)->update($request->all());
			return redirect()->to('customer/captions')->withSuccess('Caption Data Updated Successfully');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
			Caption::where('id', '=', $id)->delete();
			return redirect()->to('customer/captions')->withSuccess('caption deleted successfully');
		}
	}
