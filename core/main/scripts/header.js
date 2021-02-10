function set_header(header_id, header_len) {
    let header_identifier;
    let element;

    for(let i = 1 ; i <= header_len ; i++) {
        header_identifier = 'identifier-header-' + String(i);
        element = document.getElementById(header_identifier);
        if(i==header_id) {
            element.classList.add("active");
        } else {
            element.classList.remove("active");
        }
    }
}