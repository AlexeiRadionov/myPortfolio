var count = 0;
for (var i = 1; i < questions.length; i++) {
    do {
        var userAnswer = prompt(questions[i].question + 
            questions[i].a + questions[i].b +
            questions[i].c + questions[i].d + 
            "1 - Завершить игру и забрать деньги").toLowerCase();
        if (userAnswer != "a" && userAnswer != "b" && userAnswer != "c" 
            && userAnswer != "d" && userAnswer != "1") {
            alert("Необходимо ввести один из указанных" +
                "\nвариантов ответа (a, b, c, d, 1)");
            continue;
        }
        break;
    } while (true);
    
    if (userAnswer == "1") {
        alert("Поздравляем!!! Ваш выигрыш составил " + 
            questions[i - 1].sum +
            "\nКоличество правильных ответов: " + count);
        break;
    } else if (userAnswer == questions[i].correctAnswer) {
        count++;
        alert("Поздравляем!!! Вы ответили правильно." + 
            "\nВаш выигрыш составил " + 
            questions[i].sum);
    } else {
        alert("Ответ не верный. Вы проиграли. Игра окончена." +
            "\nКоличество правильных ответов: " + count +
            "\nВаш выигрыш составил 0 рублей");
        break;
    }
}
