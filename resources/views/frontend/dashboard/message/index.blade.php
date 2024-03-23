@extends('frontend.layouts.master')
@section('contents')
    <!--=============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    DASHBOARD START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ==============================-->
    <section id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.dashboard.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="dashboard_content">
                        <div class="dashboard_message_area">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="tf__message_list">
                                        <div class="nav flex-column nav-pills tf__massager_option" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            @foreach ($receivers as $receiver)
                                                <div class="nav-link profile-card"
                                                    data-listing-id="{{ $receiver->listingProfile->id }}"
                                                    data-receiver-id="{{ $receiver->receiverProfile->id }}"
                                                    id="v-pills-home-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-home" role="tab"
                                                    aria-controls="v-pills-home" aria-selected="true">
                                                    <div class="tf__single_massage d-flex">
                                                        <div class="tf__single_massage_img">
                                                            <img src="{{ asset($receiver->listingProfile->image) }}"
                                                                alt="person" class="img-fluid w-100 profile_img">
                                                            <span class="user-active"></span>
                                                        </div>
                                                        <div class="tf__single_massage_text">
                                                            <h4 class="profile_name">
                                                                {{ truncateText($receiver->listingProfile->title, 15) }}
                                                            </h4>
                                                            <p><i class="fas fa-crown">
                                                                </i> {{ $receiver->receiverProfile->name }}
                                                            </p>
                                                            <span class="tf__massage_time">30 min</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div class="tab-content" id="v-pills-tabContent">

                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab" tabindex="0">
                                            <div class="tf___single_chat d-none ">

                                                <div class="tf__single_chat_top">
                                                    <div class="img">
                                                        <img id="chat_img" src="images/massage-4.png" alt="person"
                                                            class="img-fluid w-100">
                                                    </div>
                                                    <div class="text">
                                                        <h4 id="chat_name">Charlene Reed</h4>
                                                        {{-- <p>active</p> --}}
                                                    </div>
                                                </div>

                                                <div class="tf__single_chat_body main_chat_inbox">


                                                </div>
                                                <form class="tf__single_chat_bottom message-form">
                                                    @csrf
                                                    <input type="hidden" id="receiver_id" name="receiver_id"
                                                        value="">
                                                    <input type="hidden" id="listing_id" name="listing_id" value="">

                                                    <input id="message" type="text" placeholder="Type a message..."
                                                        name="message">
                                                    <button class="tf__massage_btn"><i
                                                            class="fas fa-paper-plane"></i></button>
                                                </form>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    DASHBOARD START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ==============================-->
@endsection
@push('scripts')
    <script>
        const mainChatInbox = $('.main_chat_inbox');
        const loader = ` <div class=" d-flex justify-content-center align-items-center"
                                                        style="height: 500px">
                                                        <div class="spinner-border" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>`;

        function updateChatProfile(data) {
            let profileImage = data.find('.profile_img').attr('src');
            let profileName = data.find('.profile_name').text();

            $('#chat_img').attr('src', profileImage);
            $('#chat_name').text(profileName);

            // set listing id and receiver id in messaqge form
            let listingId = data.data('listing-id');
            let receiverId = data.data('receiver-id');
            $('#listing_id').val(listingId);
            $('#receiver_id').val(receiverId);
        }

        function scrollToBottom() {
            mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"));
        }

        function formatDateTime(dateTimeString) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
            }

            const formattedDateTime = new Intl.DateTimeFormat('en-US', options).format(new Date(
                dateTimeString));

            return formattedDateTime;
        }



        $(document).ready(function() {
            const baseUri = "{{ asset('/') }}"
            $('.profile-card').on('click', function() {

                //make chat box visible
                $('.tf___single_chat').removeClass('d-none');
                //update chat profile
                updateChatProfile($(this));

                //clear chat inbox
                mainChatInbox.html("");

                //fetch chat data
                let listingId = $(this).data('listing-id');
                let receiverId = $(this).data('receiver-id');
                $.ajax({
                    method: 'GET',
                    url: '{{ route('user.get-messages') }}',
                    data: {
                        'listing_id': listingId,
                        'receiver_id': receiverId
                    },
                    beforeSend: function() {
                        mainChatInbox.html(loader);
                    },
                    success: function(response) {
                        mainChatInbox.html("");
                        $.each(response, function(index, value) {
                            const imgUrl = baseUri.replace(/\/$/, '') + value
                                .sender_profile.avatar;

                            if (value.sender_id == USER.id) {
                                var message = `<div class="tf__chating tf_chat_right">
                                                        <div class="tf__chating_text">
                                                            <p>${value.message}</p>
                                                            <span>${formatDateTime(value.created_at)}</span>
                                                        </div>
                                                        <div class="tf__single_massage_img">
                                                            <img src="${imgUrl}" alt="person"
                                                                class="img-fluid w-100">
                                                        </div>
                                                    </div>`
                            } else {
                                var message = `  <div class="tf__chating">
                                                        <div class="tf__chating_img">
                                                            <img src="${imgUrl}" alt="person"
                                                                class="img-fluid w-100 rounded-circle">
                                                        </div>
                                                        <div class="tf__chating_text">
                                                            <p>${value.message}</p>
                                                            <span>${formatDateTime(value.created_at)}</span>
                                                        </div>
                                                    </div>`;
                            }
                            mainChatInbox.append(message);
                        });
                        scrollToBottom();
                    },
                    error: function(xhr, status, error) {},

                });
            });

            //send message
            $('.message-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let messageData = $('#message').val();
                var formSubmitting = false;


                if (formSubmitting || !messageData) {
                    return;
                }

                //set message in chat inbox
                let message = `<div class="tf__chating tf_chat_right">
                                                        <div class="tf__chating_text">
                                                            <p>${messageData}</p>
                                                           <span class="sending"> Sending..</span>
                                                        </div>
                                                        <div class="tf__single_massage_img">
                                                            <img src="${USER.avatar}" alt="person"
                                                                class="img-fluid w-100">
                                                        </div>
                                                    </div>`
                mainChatInbox.append(message);
                scrollToBottom();

                //clear message input
                $('.message-form').trigger('reset');
                $.ajax({
                    method: 'POST',
                    url: '{{ route('user.send-message') }}',
                    data: formData,
                    beforeSend: function() {
                        formSubmitting = true;
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('.sending').remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        }
                    },
                    complete: function() {
                        formSubmitting = false;
                    }
                })
            })
        });
    </script>
@endpush
