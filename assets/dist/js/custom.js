        $("#f_submit").click(function(){
            var feedback = $("#feedback").val();
            $.post("<?php echo base_url('feedback/save_feedback') ?>",{user_feedback: feedback},function(){
                alert("We've received your feedback. Thank you so much for your contribution.");
                $("#feedback").val('');
            })
        })

        $(document).on('click','#minimize',function(){
            $(".feedback-form").animate({width: '230px'},"slow");
        });

        $(document).on('click','#maximize',function(){
            $(".feedback-form").animate({width: '100%'}, "slow");
        });