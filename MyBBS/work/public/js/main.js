'use strict';
{
  const deletes = document.querySelectorAll('.delete');
  console.log(deletes);
  deletes.forEach(span => {
    span.addEventListener('click', () => {
      if (!confirm('削除しますか？')) {
        return;
      }
      span.parentNode.submit();
    });
  });
}
