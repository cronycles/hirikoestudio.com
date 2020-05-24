export default class CookieService {

    setCookie = (name, value, days = null) => {
        var expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    };

    getCookie = (name) => {
        let outcome = null;
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) == 0) {
                outcome = c.substring(nameEQ.length, c.length);
            }
        }

        return outcome;
    };

    deleteCookie = (name) => {
        document.cookie = name + '=; Max-Age=-99999999;';
    };
}
