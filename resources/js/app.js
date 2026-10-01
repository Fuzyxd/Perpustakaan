import './bootstrap';

const shell = document.querySelector('#library-shell');
const menuToggle = document.querySelector('[data-menu-toggle]');
const menuClose = document.querySelector('[data-menu-close]');

const setMenuOpen = (open) => {
	shell?.classList.toggle('menu-open', open);
	menuToggle?.setAttribute('aria-expanded', String(open));
};

menuToggle?.addEventListener('click', () => setMenuOpen(!shell?.classList.contains('menu-open')));
menuClose?.addEventListener('click', () => setMenuOpen(false));
document.addEventListener('keydown', (event) => {
	if (event.key === 'Escape') setMenuOpen(false);
});

const bookSearch = document.querySelector('[data-book-search]');
const bookRows = Array.from(document.querySelectorAll('[data-book-row]'));
const bookCount = document.querySelector('[data-book-count]');
const bookEmpty = document.querySelector('[data-book-empty]');

bookSearch?.addEventListener('input', () => {
	const query = bookSearch.value.trim().toLocaleLowerCase();
	let visibleCount = 0;

	bookRows.forEach((row) => {
		const matches = row.dataset.search.includes(query);
		row.hidden = !matches;
		if (matches) visibleCount += 1;
	});

	if (bookCount) bookCount.textContent = `${visibleCount} judul`;
	if (bookEmpty) bookEmpty.hidden = visibleCount > 0;
});
