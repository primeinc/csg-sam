@extends('beautymail::templates.ark')

@section('content')

    @include('beautymail::templates.ark.contentStart')

    <h4 class="secondary"><strong>Dear {!! $checkout->dealer->name !!}:</strong></h4>
    <br>
    <p>Thank you for the opportunity to provide a sample for your project.</p>
    <p>Per our records, you have borrowed a(n) {!! $checkout->asset->description !!} by {!! $checkout->asset->mfr->name !!} from us on {!! $checkout->created_at->toFormattedDateString() !!}.</p>

    <img border="0" style="float:left; padding-right: 10px;" src="{{ getenv('APP_URL') . '/uploads/' . $checkout->asset->image  }}" alt="CSGID #{!! $checkout->asset->id !!}" width="150px" height="200px" />
    <p>The sample was due back on {!! $checkout->expected_return_date->toFormattedDateString() !!}, approximately {!! $checkout->expected_return_date->diffForHumans() !!}.</p>
    <p>Please make arrangements to have the sample returned to us as soon as possible.</p>
    <p>Let us know if you need anything else.</p>
    <p>Thank you.</p>

    @include('beautymail::templates.ark.contentEnd')

@stop
