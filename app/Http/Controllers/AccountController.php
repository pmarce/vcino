<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Account;
use App\Bank;
use Auth;
use App\Http\Requests;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->company;

        $accounts = Account::where('company_id',$company->id );
        return view('accounts.index')->with('accounts',$accounts->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all()->lists('nombre','id');
        return view('accounts.create')->with('banks',$banks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'tipo_cuenta' => 'required|not_in:0',
            'banco' => 'required',
            'nota' => 'required',
        ]);

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);

        $account = new Account();
        $account->nombre = $request->nombre;
        $account->nro_cuenta = $request->nro_cuenta;
        $account->tipo_cuenta = $request->tipo_cuenta;
        $account->bank_id = $request->banco;
        $account->nombre_cuentahabiente = $request->nombre_cuentahabiente;
        $account->nota = $request->nota;
        $account->activa = $activa;
        $account->company_id = $company->id;

        $account->save();

        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
