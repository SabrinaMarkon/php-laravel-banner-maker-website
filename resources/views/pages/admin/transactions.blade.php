@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Financial Transactions

@stop


@section('content')

    <div class="form-page-large">

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>UserID</th>
                        <th>Transaction</th>
                        <th>Description</th>
                        <th>Date Paid</th>
                        <th>Amount</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                 <tbody>

                @foreach ($transactions as $transaction)

                    <?php
                        $date = new DateTime($transaction->datepaid);
                        $datepaid = $date->format('Y-m-d');
                     ?>
                    <tr>
                        {{ Form::open(array('route' => array('admin.transactions.update', $transaction->id), 'method' => 'PATCH', 'class' => 'form-horizontal')) }}
                        <td>{{ $transaction->id }} </td>
                        <td>{{ Form::text('userid', $transaction->userid) }} </td>
                        <td>{{ Form::text('transaction', $transaction->transaction) }} </td>
                        <td>{{ Form::text('description', $transaction->description) }} </td>
                        <td>{{ Form::text('datepaid', $datepaid) }} </td>
                        <td>{{ Form::text('amount', $transaction->amount) }} </td>
                        <td>{{ Form::submit('Save', array('class' => 'btn btn-custom skinny')) }}</td>
                        {{ Form::close() }}
                        <td>
                            {{ Form::open(array('route' => array('admin.transactions.destroy', $transaction->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-custom skinny')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop


@section('footer')



@stop