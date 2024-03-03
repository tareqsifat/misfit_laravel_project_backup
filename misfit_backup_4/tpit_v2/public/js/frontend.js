document.addEventListener("DOMContentLoaded", () => {
    Turbolinks.start()
    document.addEventListener("turbolinks:load", function (event) {
        
        if(location.pathname == '/'){
            // initiate_our_course_types();
        }

        document.querySelector(`nav a[href="${location.pathname}"]`).classList.add('active_button');
    });

    document.addEventListener("turbolinks:before-render", function (event) {
        // console.log("page before render");
    });

    document.addEventListener("turbolinks:render", function (event) {
        // console.log("page before render");
    });
});
