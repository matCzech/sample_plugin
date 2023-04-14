window.addEventListener('load', function(){

    //store tabs variables
    var tabs = document.querySelectorAll('ul.nav-tabs > li');

    for(i = 0; i < tabs.length; i++){
        tabs[i].addEventListener('click', switchTab);
    }

    function switchTab(event){
        var eventTarget = event.currentTarget;
        var anchor = event.target;
        var activePaneID = anchor.getAttribute('href');
        
        document.querySelector('ul.nav-tabs li.active').classList.remove('active');
        document.querySelector('.tab-pane.active').classList.remove('active');

        event.preventDefault();
        eventTarget.classList.add('active');
        document.querySelector(activePaneID).classList.add('active');
    }

});