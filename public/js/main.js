
function addSelectOption() {
    let select=document.createElement('select');
    select.setAttribute('name','equipments[]');
    select.classList.add('equipments');
    let option=document.createElement('option');
    option.innerText='Wybierz wyposażenie z listy...'
    select.appendChild(option);
    equipments.forEach(function(equipment){
        option=document.createElement('option');
        option.setAttribute('value',equipment.id)
        option.innerText=`${equipment.designation}. ${equipment.type} - ${equipment.model}`;
        select.appendChild(option)
    });

    divSelect.appendChild(select);

}

function detachEquipment(id){
    let request=new XMLHttpRequest();
    let param='id='+id;
    request.open('post',url,true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.setRequestHeader('X-CSRF-TOKEN', token)


    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            console.log(request.responseText)
        }
    }
    request.send(param);
    return true;

}

const append_hours_option=()=>{
    let select_input=document.querySelectorAll('.hours')
    let start_hour=8;
    let last_hour=17;

    select_input.forEach(select_input=> {
        for (i = start_hour; i < last_hour; i++) {
            let option = document.createElement('option')
            option.value = i;
            option.innerText = i;
            select_input.appendChild(option);
        }
    });


}

function check_reservation(workplace_id, name, surname, phone_number,mail, description, date, from_hours,to_hours){


    //Validation data
    if(empty_input_value([workplace_id, name, surname, phone_number,mail, description, date,from_hours,to_hours])) {
        document.querySelector('.error-message p').innerText="Wprowadź wszystkie dane";
        return false;
    }
    if(!(string_validation(name) & string_validation(surname) & phone_number_validation(phone_number) &
        email_validation(mail) & string_validation(description) & date_validation(date) &
        integer_validation(from_hours) & integer_validation(to_hours)) & from_hours>to_hours){

        document.querySelector('.error-message p').innerText="Niepoprawne dane";
        return false;
    }
        // Sends data to a php function
        let request = new XMLHttpRequest();
        let param = 'workplace_id=' + workplace_id + '&name='+ name + '&surname='+ surname +
            '&phone_number='+ phone_number + '&mail='+ mail + '&description='+ description +
            '&date=' + date + '&from_hours=' + from_hours + '&to_hours=' + to_hours;

        request.open('post', url, true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.setRequestHeader('X-CSRF-TOKEN', token);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('.response').innerText = request.responseText;

            }
        }
        request.send(param);
        return true;

}

function list_reservation_of_day(workplace_id, date) {
    let request=new XMLHttpRequest();
    let param=`workplace_id=${workplace_id} & date=${date}`;

    request.open('post', fetch_reservation_of_day_url)
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.setRequestHeader('X-CSRF-TOKEN', token);

    request.onreadystatechange=function () {
        if (request.readyState==4 && request.status==200){
            const response_div=document.querySelector('.response');
            response_div.innerText=`W dniu ${date} istnieją już rezerwacje w godzinach`;
            const ul=document.createElement("ul");

            let arr=JSON.parse(request.responseText);
            arr.forEach(reservation=>{
                const li=document.createElement("li");
                li.innerText=`${reservation.from_hours} - ${reservation.to_hours+0.1}`;
                ul.appendChild(li);

            });
            response_div.appendChild(ul);
            console.log(arr);
        }
    }
    request.send(param);
}

function empty_input_value(inputs) {

    return inputs.some(function (input) {

        return input.length==0 || input==null;

    });

}

function email_validation(email){
    return (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email));

}
function phone_number_validation(phone_number) {
    return (/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/.test(phone_number));

}
function date_validation(date) {
    return (/^([12]\d{3})-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/.test(date));
}
function integer_validation(integer){
    return(/(\d)$/.test(integer));
}
function string_validation(string) {
    return (/(\w)/.test(string));
}






