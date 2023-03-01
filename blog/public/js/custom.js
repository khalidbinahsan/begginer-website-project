// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................
// Contact send
$('#contact-send').click(function (){
    var contactName = $('#contact-name').val();
    var contactPhone = $('#contact-phone').val();
    var contactEmail = $('#contact-email').val();
    var contactMsg = $('#contact-msg').val();
    if(contactName.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Name is empty!');
    } else if(contactPhone.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Phone is empty!');
    } else if(contactEmail.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Email is empty!');
    } else if(contactMsg.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Message is empty!');
    } else {
         $('#contact-name').val('');
           $('#contact-phone').val('');
           $('#contact-email').val('');
           $('#contact-msg').val('');
        axios.post('/contactSubmitted', {
            contact_name: contactName,
            contact_mobile: contactPhone,
            contact_email: contactEmail,
            contact_msg: contactMsg
        })
            .then(function (response){
                if(response.data == 1){
                    $('#success-notifications').toast('show');
                    $('#success-notifications h5').html('Message send successfully');
                } else {
                    $('#error-notifications').toast('show');
                    $('#error-notifications .error-msg').html('Message sending failed');
                }
            })
            .catch(function (error){
                $('#error-notifications').toast('show');
                $('#error-notifications .error-msg').html('Message sending failed');
            })
    }


})












