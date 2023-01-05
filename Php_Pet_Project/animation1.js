function HeaderForm() {
    header = document.getElementById("headMainTitle");
    selectForm = document.getElementById("supplier");
    mainForm = document.getElementById("headerForm");
    console.log(selectForm.value);
    header.innerHTML = selectForm.value;
    mainForm.submit();
//    header.innerHTML = selectForm.value;
}

function FindContent() {
    this.selectForm = document.getElementById("servises");
    this.selectServiseHeader = document.getElementById("headServises");
    
}

FindContent.prototype.initSettings = function() {
    this.selectForm.addEventListener('change', () => this.servises());
}

FindContent.prototype.servises = function() {
    console.log(this.selectServiseHeader);
    this.selectServiseHeader.innerHTML = this.selectForm.value;
}



let findContent = new FindContent();
findContent.initSettings();

