window.addEventListener('DOMContentLoaded', function(){
    const quize_pages = document.querySelectorAll('.quizle-page');

    const quizle_close = document.createElement('button'); // Создаём кнопку Добавить ещё          
    
    quizle_close.classList.add('quizle-close-btn'); // Присваиваем её стили

    const quizle_captcha_cont = document.createElement('div'); // Создаём кнопку Добавить ещё          
    
    quizle_captcha_cont.classList.add('smart-captcha'); // Присваиваем её стили    

    quizle_captcha_cont.setAttribute('id', 'bpn1timptiqfkkfcm1ch');

    quizle_captcha_cont.setAttribute('data-sitekey', 'ysc1_OOM59wevTesUUMzvsTrFDRIFDshAKAwM5bJDk5LL950e15b0');

    quize_pages.forEach(function(quize_page){       

        quize_page.append(quizle_close);

        quizle_close.addEventListener('click', function(enent){
            window.location.href='/';
        })

        const quizle_form = quize_page.querySelector('form');
    

        
        
    });

});