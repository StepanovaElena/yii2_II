var messages;


document.addEventListener('DOMContentLoaded', function () {
    console.log('Aloha');
    var conn = new WebSocket('ws://y2aa-backend.test:8123');

//функция отправки сообщения
    function sendMessage() {
        conn.send(document.getElementById('messageInput').value);
    }

    conn.onopen = function (e) {
        console.log("Connection established!");
    };

    conn.onmessage = function (e) {
        console.log(e.data);
        var $elem = $('li.messages-menu ul.menu li:first').clone;
        $elem.find('p').text(e.data);
        $elem.find('h4').text(e);
        $elem.prepend('li.messages-menu ul.menu');

        var $count = $('li.messages-menu ul.menu li').length;
        $('ul.dropdown-menu li.header span').text($count);
        $('a.dropdown-toggle span.label-success').text($count);
    };

    conn.onerror = function (e) {
        console.log("Connection failed!");
    };

// Запрещаем submit формы, чтобы не обновлять страницу (иначе затираются сообщения)
    document.getElementById('messageForm').addEventListener('submit', function (event) {
        event.preventDefault();
        sendMessage();
    });


});