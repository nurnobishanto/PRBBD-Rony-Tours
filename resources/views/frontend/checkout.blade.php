@extends('layouts.frontend')
@section('main_content')
<section >
    <div style="height: 100px"></div>
</section>
<section id="">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Departure : DAC - CGP : 21-May-23
                    </div>
                    <div class="card-body">
                        NOVOAIR (909)
                        12:00 - 12:55
                        VQ -909: From DAC (21-May-23 12:00 PM) To CGP (21-May-23 12:55 PM)
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Passenger List &nbsp;&nbsp;
                        <span style="font-size: 1.3rem; color: #fff"><i class="fas fa-male pr-1" style="color: #fff;" aria-hidden="true"></i><span style="font-size: 1.1rem;">1</span></span>
                        <span style="font-size: 1.1rem; color: #fff"><i class="fas fa-child pr-1" style="color: #fff;" aria-hidden="true"></i><span style="font-size: 1.1rem;">0</span></span>
                        <span style="font-size: 1rem; color: #fff"><i class="fas fa-baby pr-1" style="color: #fff;" aria-hidden="true"></i><span style="font-size: 1.1rem;">0</span></span>
                    </div>
                    <div class="card-body">
                        <!-- Passenger List -->
                        <div id="passengerList"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Passenger
                        </button>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox1" name="checkboxGroup">
                            <label class="form-check-label" for="checkbox1">
                                Checkbox 1
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox2" name="checkboxGroup">
                            <label class="form-check-label" for="checkbox2">
                                Checkbox 2
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox3" name="checkboxGroup">
                            <label class="form-check-label" for="checkbox3">
                                Checkbox 3
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="2">Bill ID: 146518 - MD NURNOBI HOSEN</th>
                            </tr>
                            <tr>
                                <th>Total Fare</th>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <th>Net Pay</th>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-danger font-italic">Avail Extra Discount on selected Card
                                    T&C Apply</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="small">
                                    <span class="text-bold">Refund</span>
                                    <hr>
                                    Cancellation Fee = Airline's Fee + Amy's Fee (BDT 300)
                                    Refund Amount = Paid Amount - Cancellation Fee
                                    <hr>
                                    <span class="text-bold">Re-issue</span>
                                    <hr>
                                    Re-issue Fee= Airline's Fee + Fare Difference + Amy's Fee ( BDT 200 )
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Payment Options
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Select a Payment Option</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentOption" id="option1" value="option1">
                            <label class="form-check-label" for="option1">
                                Credit Card
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentOption" id="option2" value="option2">
                            <label class="form-check-label" for="option2">
                                PayPal
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentOption" id="option3" value="option3">
                            <label class="form-check-label" for="option3">
                                Bank Transfer
                            </label>
                        </div>

                        <div class="text-danger small">
                            We Don't Save any of your Card's information. We will redirect you to Bank's Secured Payment Gateway.
                            Please complete payment within 10 minutes.
                            BKash/Nagad Charge, Credit Card Charge Applicable.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



    <script>
        $(document).ready(function() {
            // Add Passenger button click event
            $('#addPassengerBtn').click(function (){

            })

        });
    </script>


@endsection
