let darkmodeToggler = document.getElementById("darkmode-toggler");
let lightBulb = document.getElementById("lightbulb-path");
let body = document.body;



// DARK MODE
darkmodeToggler.addEventListener('click', function () {
    if(!body.classList.contains('dark-mode')) {
        localStorage.clear();
        localStorage.setItem('theme', 'dark');
        body.classList.add('dark-mode');
        lightBulb.setAttribute("d", "M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 " +
            "1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553" +
            "H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302" +
            "l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 " +
            "8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941" +
            "A5 5 0 0 0 8 1z");
    } else if(body.classList.contains('dark-mode')) {
        localStorage.clear();
        localStorage.setItem('theme', 'light');
        body.classList.remove('dark-mode');
        lightBulb.setAttribute("d", "M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 " +
            "1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-." +
            "618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 " +
            "0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z");
    }
})

if(localStorage.getItem('theme') === 'dark') {
    lightBulb.setAttribute("d", "M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.76" +
        "9A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1" +
        " 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a" +
        "1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.5" +
        "14.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z");
    body.classList.add('dark-mode');
}

// JavaScript to show/hide the text area based on dropdown selection
document.getElementById("site_attended").addEventListener("change", function() {
    let select = this;
    let newSite = document.getElementById("new_site_attended");
    let textArea = document.getElementById("new_location");
    let siteSelection = document.getElementById("site_attended_selector");

    newSite.style.display = (select.value === "new") ? "block" : "none";
    siteSelection.style.display = (select.value === "new") ? "none" : "block";
    textArea.required = (select.value === "new");
});







