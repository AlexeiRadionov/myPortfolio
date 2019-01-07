var event, ok, n;

do {
    do {//Выводим первый вопрос
        ok = false;
        event = +prompt(works.a000 + works.a00 + works.a1 + works.a2 + '-1 - Выход из игры');
        if (event == -1) {
            break;
        }
        else {
            ok = isAnswer(works.a0, event);
        }
    } while (!ok);
    do {
        if (n == 2) {
            event = 1;
        } else if (n == 3) {
            event = 2;
        }
        switch (event) {
            case 1: // Первое действие  - если в первом окне ввели 1 то открываем серию окон - окно 2
                do {
                    ok = false;
                    event = +prompt(works.b000 + works.b00 + works.b1 + works.b2 + '-1 - Выход из игры');
                    if (event == -1) {
                        break;
                    }
                    else {
                        ok = isAnswer(works.b0, event);
                    }
                } while (!ok);
                do {
                    switch (event) {
                        case 1: // Второе действие, если во 2 окне ввели 1 то переходим на 4 окно
                            do {
                                ok = false;
                                event = +prompt(works.d000 + works.d00 + works.d1 + works.d2 + '-1 - Выход из игры');
                                if (event == -1) {
                                    break;
                                }
                                else {
                                    ok = isAnswer(works.d0, event);
                                }
                            } while (!ok);

                            break;
                        case 2: // Второе действие   Если ввели 2 то также переходим на 4 окно
                            do {
                                ok = false;
                                event = +prompt(works.d000 + works.d00 + works.d1 + works.d2 + '-1 - Выход из игры');
                                if (event == -1) {
                                    break;
                                }
                                else {
                                    ok = isAnswer(works.d0, event);
                                }
                            } while (!ok);

                            break;
                        case -1: // Второе действие
                            break;
                        default:
                            alert('Ошибка');
                    }

                    if (event == -1) {
                        break;
                    }
                    n = +prompt("Введите номер окна (1, 2, 3 или 4) или (-1 - Выход из игры) ");
                } while (n == 4);
                break;
            case 2: // Первое действие    Если в 1 окне ввели 2 то переходим к 3 окну
                do {
                    ok = false;
                    event = +prompt(works.c000 + works.c00 + works.c1 + works.c2 + '-1 - Выход из игры');
                    if (event == -1) {
                        break;
                    }
                    else {
                        ok = isAnswer(works.c0, event);
                    }
                } while (!ok);
                do {
                    switch (event) {
                        case 1: // Второе действие
                            do {
                                ok = false;
                                event = +prompt(works.d000 + works.d00 + works.d1 + works.d2 + '-1 - Выход из игры');
                                if (event == -1) {
                                    break;
                                }
                                else {
                                    ok = isAnswer(works.d0, event);
                                }
                            } while (!ok);

                            break;
                        case 2: // Второе действие
                            do {
                                ok = false;
                                event = +prompt(works.d000 + works.d00 + works.d1 + works.d2 + '-1 - Выход из игры');
                                if (event == -1) {
                                    break;
                                }
                                else {
                                    ok = isAnswer(works.d0, event);
                                }
                            } while (!ok);

                            break;
                        case -1: // Второе действие
                            break;
                        default:
                            alert('Ошибка');
                    }

                    if (event == -1) {
                        break;
                    }
                    n = +prompt("Введите номер окна (1, 2, 3 или 4) или (-1 - Выход из игры) ");
                } while (n == 4);
                break;
            case -1: // Первое действие
                break;
            default:
                alert('Ошибка');
        }
    
    } while ((n == 2 || n == 3) && event != -1);
} while (n == 1 && event != -1);

alert('Спасибо за игру');

//------------------------------------------
function isAnswer(q, event) {
    if (isNaN(event) || !isFinite(event)) {
        alert('Вы ввели недопустимый символ');
        return false;
    }
    else if (event < 1 || event > q) {
        alert('Ваше число выходит из допустимого диапозона');
        return false;
    }
    return true;
    
}