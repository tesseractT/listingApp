@extends('frontend.layouts.master')
@section('contents')
    <!--==========================
                                                                                                                                                                                                                    BREADCRUMB PART START
                                                                                                                                                                                                                ===========================-->
    {{-- <div id="breadcrumb_part">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>Payment Successful</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"> Home </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Payment Success </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--==========================
                                                                                                                                                                                                                    BREADCRUMB PART END
                                                                                                                                                                                                                ===========================-->


    <!--==========================
                                                                                                                                                                                                                    LISTING PAGE START
                                                                                                                                                                                                                ===========================-->
    <section id="wsus__package">
        <div class="wsus__package_overlay">
            <div class="container">
                <div class="text-center">
                    <i style="font-size: 100px; color:green" class="fas fa-check-circle"></i>
                    <h5>Payment Successful</h5>
                    <p>Thank you for your payment. Your transaction has been completed and a receipt for your purchase has
                        been emailed to you.</p>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-warning mt-4">Go to Dashboard</a>
                </div>

            </div>
        </div>
    </section>



    <!--==========================
                                                                                                                                                                                                                    LISTING PAGE START
                                                                                                                                                                                                                ===========================-->
@endsection
