'use sctrict';

document.addEventListener('DOMContentLoaded', function () {
    let parent = document.querySelector('.table__body');
    let firstSort = document.querySelector('.table__header .sort-btn[data-sort-column="0"]');

    // Вспомогательная функция - вставка элемента после
    function insertAfter(elem, refElem) {
        return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
    }

    // Находим кнопки сортировки
    let sortBtns = document.querySelectorAll('.sort-btns>div');
    let sortBtnsArray = Array.prototype.slice.call(sortBtns);

    // Функция сортировки
    function sort(direction, selector, elem) {
        if (direction != 'up' && direction != 'down') return;

        sortBtnsArray.forEach(btn => {
            btn.classList.remove('sort--up');
            btn.classList.remove('sort--down');
        });

        if (direction == 'down') {
            for (let i = 0; i < parent.children.length; i++) {
                for (let j = i; j < parent.children.length; j++) {
                    if (
                        +parent.children[i].querySelector(selector).getAttribute('data-sort')
                        <
                        +parent.children[j].querySelector(selector).getAttribute('data-sort')
                    ) {
                        replaceNode = parent.replaceChild(parent.children[j], parent.children[i]);
                        insertAfter(replaceNode, parent.children[i])
                    }
                }
            }
            elem.classList.add('sort--down');
        };
        if (direction == 'up') {
            for (let i = 0; i < parent.children.length; i++) {
                for (let j = i; j < parent.children.length; j++) {
                    if (
                        +parent.children[i].querySelector(selector).getAttribute('data-sort')
                        >
                        +parent.children[j].querySelector(selector).getAttribute('data-sort')
                    ) {
                        replaceNode = parent.replaceChild(parent.children[j], parent.children[i]);
                        insertAfter(replaceNode, parent.children[i])
                    }
                }
            }
            elem.classList.add('sort--up');
        };
    };

    // Сортировка при открытии страницы по сумме очков вверх
    sort('down', `[data-sort-column="0"]`, firstSort);

    // Вешаем слушатель на каждый див
    if (sortBtns) {
        sortBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                let column = btn.getAttribute('data-sort-column'); // находим номер столбца, по которому будем сортировать

                // если на псевдокнопке уже есть класс sort--down - меняем классы, сортируем вверх
                if (btn.classList.contains('sort--down')) {
                    sort('up', `[data-sort-column="${column}"]`, btn);
                } else {
                    // иначе сортируем по умолчанию вниз
                    sort('down', `[data-sort-column="${column}"]`, btn);
                }
            })
        });
    };

    // проставляем места
    let placeCells = document.querySelectorAll('.table__place');
    let currInd = 1;
    placeCells.forEach(cell => {
        cell.textContent = currInd;
        currInd++
    });
});