function myFunction(x) {
  if (x.matches) { // If media query matches
        $(".submenu").removeClass("menuperf");

    $("#tabsForm").removeClass('tabs-vertical');
    $("#tabsForm").removeClass('tabs-left');
  } else {

    $("#tabsForm").addClass("tabs-vertical");
        $("#tabsForm").addClass("tabs-left");
        $(".submenu").addClass("menuperf");
  }
}

var x = window.matchMedia("(max-width: 769px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes