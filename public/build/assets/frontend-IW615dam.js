function r(){$(".main_chat_inbox").scrollTop($(".main_chat_inbox").prop("scrollHeight"))}window.Echo.private("message."+USER.id).listen("Message",i=>{console.log(i);let e=$(".main_chat_inbox").attr("data-inbox-user"),a=$(".main_chat_inbox").attr("data-inbox-listing");if(e===i.user.id&&a===i.listing_id){var s=`  <div class="tf__chating">
    <div class="tf__chating_img">
        <img src="${i.user.avatar}" alt="person"
            class="img-fluid w-100 rounded-circle">
    </div>
    <div class="tf__chating_text">
        <p>${i.message_data}</p>
    </div>
</div>`;$(".main_chat_inbox").append(s),r()}$(".profile-card").each(function(){let t=$(this).data("receiver-id"),d=$(this).data("listing-id");t==i.user.id&&d==i.listing_id&&$(this).find(".profile_img").addClass("new_message")})});window.Echo.join("online").here(i=>{$.each(i,function(e,a){$(".profile-card").each(function(){$(this).data("receiver-id")==a.id&&$(this).find(".user-status").addClass("user-active")})})}).joining(i=>{$(`.profile-card[data-receiver-id="${i.id}"]`).find(".user-status").addClass("user-active")}).leaving(i=>{$(`.profile-card[data-receiver-id="${i.id}"]`).find(".user-status").removeClass("user-active")});
