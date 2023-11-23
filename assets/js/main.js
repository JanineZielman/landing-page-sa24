// A $( document ).ready() block.
$( document ).ready(function() {

    //$(".hide-at-pageload").hide();
    //$(".hide-at-pageload").css({
    //    "opacity":1
    //});

    $(".locations-item").each(function(){
        $(this).blast({
            delimiter: "character" // Set the delimiter type (see left)
         });
    })

    async function getNews() {
        console.log("news")

        //?filters[biennials][slug][$eq]=biennial-2022&sort[0]=date%3Adesc&populate=*

        //sonic acts filter
        //const response = await fetch("https://cms.sonicacts.com/api/news-items?filters[biennials][slug][$eq]=biennial-2022&sort[0]=date%3Adesc&populate[content][populate]=*");

        //const responseCoverImages = await fetch("https://cms.sonicacts.com/api/news-items?filters[biennials][slug][$eq]=biennial-2022&sort[0]=date%3Adesc&populate=*");

        //const response = await fetch("https://cms.sonicacts.com/api/news-items?populate=*");


        const response = await fetch("https://cms.sonicacts.com/api/news-items?filters[biennials][slug][$eq]=biennial-2024&sort[0]=date%3Adesc&populate[content][populate]=*&populate[cover_image][populate]=*");


        const news = await response.json();
        console.log(news.data);

        $.each(news.data, function( index, value ) {

            //console.log(value.attributes);

            //cms.sonicacts.com/uploads/Anthea_Caddy_Live_02_HKW_9abd4498e9.jpeg?w=1000&q=75

            var $news = $("<div class='news-item'></div>");
            var $newsImage = $("<div class='news-image'></div>");
            var $newsContent = $("<div class='news-content'></div>");

            var $newsHeadlineWrapper = $("<div class='news-headline-wrapper'></div>");
            var $newsHeadline = $("<h2 class='news-headline'>"+marked.parse(value.attributes.title)+"</h2>");
            var $newsDate = $("<div class='news-date'>"+value.attributes.date+"</div>");

            $newsHeadlineWrapper.append($newsHeadline);
            $newsHeadlineWrapper.append($newsDate);
            $newsContent.append($newsHeadlineWrapper);



            console.log(value.attributes);

            if (value.attributes.cover_image) {
                console.log(value.attributes.cover_image);

                if (value.attributes.cover_image.data && value.attributes.cover_image.data.attributes && value.attributes.cover_image.data.attributes.formats && value.attributes.cover_image.data.attributes.formats.large && value.attributes.cover_image.data.attributes.formats.large.url) {
                    $newsImage.html("<img src='https://cms.sonicacts.com"+value.attributes.cover_image.data.attributes.formats.large.url+"'>");
                }

                $news.append($newsImage);
            }


            $.each(value.attributes.content, function( index, value ) {

                if (value.__component == "basic.text") {
                    $newsContent.append(marked.parse(value.text_block));
                    return false;
                }

            })

            $news.append($newsContent);


            var $moreContent = $("<div class='more-content' style='max-height:0; overflow:hidden;'></div>");


            var ignoreFirst = true;

            $.each(value.attributes.content, function( index, value ) {

                //console.log(value);

                if (value.__component == "basic.text") {

                    if (ignoreFirst) {
                        ignoreFirst = false;
                    } else {
                        $moreContent.append(marked.parse(value.text_block));
                    }
                }

                if (value.__component == "basic.image") {
                    //console.log(value.image.data.attributes.url);

                    if (value && value.image && value.image.data && value.image.data.attributes && value.image.data.attributes.formats && value.image.data.attributes.formats.large && value.image.data.attributes.formats.large.url) {

                        $moreContent.append("<img src='https://cms.sonicacts.com"+value.image.data.attributes.formats.large.url+"'>");
                    }
                }

                if (value.__component == "basic.embed") {
                    $moreContent.append(value.url);
                }

            })


            $newsContent.append($moreContent);


            var $readMoreButton = $('<div class="read-more read-more-news"><div class="read-more-inner">read more</div></div>');

            $readMoreButton.click(function(){
                //console.log("click");

                $(this).closest(".news-item").addClass("open");

                $(this).fadeOut();

                $moreContent.animate({
                    "max-height": $(window).height(),
                }, 1000, function() {

                    //console.log("done animating");

                    $moreContent.css({
                        "max-height": "unset"
                    })
                });
            });

            $news.append($readMoreButton);


            $("#news").append($news)


        });
    }

    getNews();




    setTimeout(function(){

        $("#center-type").addClass("visible");

        setTimeout(function(){

            $("#background-1").addClass("visible");

            setTimeout(function(){

                $("#title-1-sonic, #title-1-sonic-mobile").addClass("visible");


                setTimeout(function(){

                    $("#background-2").addClass("visible");

                    setTimeout(function(){

                        $("#normal-01").addClass("visible");

                        setTimeout(function(){

                            setTimeout(function(){
                                $("#title-2-acts, #title-2-acts-mobile, #fake-table, #sa-logo").addClass("visible");

                                setTimeout(function(){
                                    $("#b-2024, #social-homelink").addClass("visible");

                                    $("#date").addClass("visible");

                                    setTimeout(function(){
                                        $("#sub-title").addClass("visible");

                                        setTimeout(function(){
                                            $("#table-top").addClass("visible");

                                            $("#locations").css({
                                                "display":"block",
                                                "opacity":1
                                            })

                                            $(".locations-item span").each(function(i){

                                                var span = $(this);
                                                span.css({
                                                    "opacity":0
                                                });

                                                setTimeout(function(){
                                                    span.css({
                                                        "opacity":1
                                                    });
                                                }, 100*i)

                                            })


                                            counter = 0;

                                            setTimeout(function(){

                                                $("#normal-02").addClass("visible");

                                                setInterval(function(){
                                                    counter++;

                                                    if (counter%2 == 0) {
                                                        $("#normal-01 .normal-image").fadeOut("slow");
                                                        $("#normal-02 .normal-image").fadeIn("slow");
                                                    }
                                                    if (counter%2 == 1) {
                                                        $("#normal-02 .normal-image").fadeOut("slow");
                                                        $("#normal-01 .normal-image").fadeIn("slow");
                                                    }

                                                }, 5000);

                                            }, 10000);


                                        }, 300);

                                    }, 300);

                                }, 300);

                            }, 300);

                        }, 300);

                    }, 300);

                }, 300);

            }, 300);

        }, 400);

    }, 300);


    $("#curatorial-statement").each(function(){

       var wrapper = $(this);

       wrapper.find(".read-more-inner").click(function(){

           var readMoreButton = $(this);

           wrapper.find(".closed").addClass("opening");

           setTimeout(function(){

               wrapper.find(".closed").removeClass("opening").addClass("open");

               readMoreButton.fadeOut();

           }, 2000);

           $(".background-layer-1").fadeIn();

       });

    });


    $(".news-item").each(function(){

       var wrapper = $(this);

       wrapper.find(".read-more-inner").click(function(){

           var readMoreButton = $(this);

           wrapper.find(".closed").addClass("opening");

           readMoreButton.css({
               'opacity':0,
               'pointer-events': 'none'
           });

           setTimeout(function(){

               wrapper.find(".closed").removeClass("opening").addClass("open");

           }, 2000);

       });



       wrapper.find("h2.news-headline").click(function(){

           var readMoreButton = wrapper.find('.read-more-inner');

           wrapper.find(".closed").addClass("opening");

           readMoreButton.css({
               'opacity':0,
               'pointer-events': 'none'
           });

           setTimeout(function(){

               wrapper.find(".closed").removeClass("opening").addClass("open");

           }, 2000);

       });

    });



    $(window).scroll(function() {

        //console.log($(window).scrollTop());

        var scrollTop = $(window).scrollTop();

        $("#title-1-sonic, #title-1-sonic-mobile").css({
            "transform":"translate(-50%, calc(-50% - " + scrollTop * 0.4 + "px))"
        })

        $("#title-2-acts, #title-2-acts-mobile").css({
            "transform":"translate(-50%, calc(-50% - " + scrollTop * 0.8 + "px))"
        })


        $("#svg-biennial").css({
            "transform":"translateY(" + scrollTop * 0.4 + "px)"
        })

        $("#svg-2024").css({
            "transform":"translateY(" + scrollTop * 0.8 + "px)"
        })


        $("#svg-bottom-table").css({
            "transform":"translateY(" + scrollTop * 0.5 + "px)"
        })

        $("#background-1, #normal-01").css({
            "opacity": 1 - scrollTop/120
        })

        $("#background-bottom").css({
            "transform":"translateY(" + -1 * Math.min(scrollTop, $(window).width()*0.4) + "px)"
        })



        var maxScroll = $(window).width() * 0.1;
        var maxScale = $(window).width() * 0.17; //how small it gets, the smaller the number the smaller

        //if (scrollTop < maxScroll) {
        //    var scrollRelation = scrollTop / maxScale;
        //
        //    $("#svg-biennial").css({
        //        "transform":"scale("+ (1 - scrollRelation) +")",
        //        "transform-origin" : "bottom left"
        //    })
        //
        //
        //    $("#svg-2024").css({
        //        "transform":"scale("+ (1 - scrollRelation) +")",
        //        "transform-origin" : "bottom right"
        //    })
        //}


//        $("#table-1").css({
//            "transform":"translateY(+" + scrollTop * 0.3 + "px)"
//        })
//
//        $("#table-2").css({
//            "transform":"translateY(+" + scrollTop * 0.05 + "px)"
//        })
//
//        $("#table-3").css({
//            "transform":"translateY(+" + scrollTop * 0.4 + "px)"
//        })
//
//        $("#table-4").css({
//            "transform":"translateY(+" + scrollTop * 0.01 + "px)"
//        })

        //console.log(scrollTop, $("#intro-wrapper").outerHeight() + $("#curatorial-statement").outerHeight() - $(window).height(), $(window).height());

        if (
            scrollTop > ($("#intro-wrapper").outerHeight() + $("#curatorial-statement").outerHeight() - $(window).height())
            || scrollTop < $(window).height()/2
        ) {
            $(".background-layer-1").fadeOut();
        } else {

            $(".background-layer-1").fadeIn();
        }
    })


    var closer = $("<div class='closer'>x</div>");

    closer.click(function(){
        $(this).closest(".closer-target").hide();
    });



    var formsignup = $('#mc_embed_shell');

    formsignup.append(closer.clone(true));

    $(".newsletter").click(function(){
        formsignup.show();
    });


    $("#imprint-content").addClass("closer-target").append(closer.clone(true));

    $("#imprint-link").click(function(){
        $("#imprint-content").show();
    });

});