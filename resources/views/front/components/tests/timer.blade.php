<div class="testing__timer">
    <div class="timer">
        <div class="timer-title">Осталось времени</div>
        <div class="timer-wrap">
            <div class="timer-item timer__hours">01</div>
            <div class="timer-item timer__minutes">30</div>
            <div class="timer-item timer__seconds">00</div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // конечная дата, например 1 июля 2021
        const deadline = new Date(
            {{ $date_in_ms }}
        );
        // id таймера
        let timerId = null;
        // склонение числительных
        function declensionNum(num, words) {
            return words[(num % 100 > 4 && num % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(num % 10 < 5) ? num % 10 : 5]];
        }
        // вычисляем разницу дат и устанавливаем оставшееся времени в качестве содержимого элементов
        function countdownTimer() {
            const diff = deadline - new Date();
            if (diff <= 0) {
                clearInterval(timerId);
            }
            const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
            const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
            const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
            $hours.textContent = hours < 10 ? '0' + hours : hours;
            $minutes.textContent = minutes < 10 ? '0' + minutes : minutes;
            $seconds.textContent = seconds < 10 ? '0' + seconds : seconds;
            // $hours.dataset.title = declensionNum(hours, ['час', 'часа', 'часов']);
            // $minutes.dataset.title = declensionNum(minutes, ['минута', 'минуты', 'минут']);
            // $seconds.dataset.title = declensionNum(seconds, ['секунда', 'секунды', 'секунд']);
        }
        // получаем элементы, содержащие компоненты даты
        const $hours = document.querySelector('.timer__hours');
        const $minutes = document.querySelector('.timer__minutes');
        const $seconds = document.querySelector('.timer__seconds');
        // вызываем функцию countdownTimer
        countdownTimer();
        // вызываем функцию countdownTimer каждую секунду
        timerId = setInterval(countdownTimer, 1000);
    });
</script>
