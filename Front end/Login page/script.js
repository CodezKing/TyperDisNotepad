let wrapper = document.querySelector("#wrapper");
let header = document.querySelector("#header");
let actions = document.querySelector("#actions");
let isMouseDown = false;

let offsetX = 0;
let offsetY = 0;

function toggleMaximize() {
    // Toggle a 'maximized' state that adds/removes full-screen classes
    if (!wrapper.classList.contains('maximized')) {
        // store previous position so we can restore
        wrapper.dataset.prevLeft = wrapper.style.left || '';
        wrapper.dataset.prevTop = wrapper.style.top || '';
        // store whether wrapper had m-auto (centered)
        wrapper.dataset.hadAuto = wrapper.classList.contains('m-auto') ? '1' : '0';
        wrapper.classList.add('maximized');
        wrapper.classList.remove('w-[350px]','h-[420px]');
        wrapper.classList.add('left-0','top-0','right-0','bottom-0','w-full','h-full');
        wrapper.classList.remove('m-auto');
        wrapper.style.left = '';
        wrapper.style.top = '';
        // store and update header so it spans full width
        if (header) {
            header.dataset.prevClass = header.className || '';
            header.dataset.prevStyle = header.getAttribute('style') || '';
            header.classList.remove('w-[350px]','border-2');
            header.classList.add('w-full');
            // remove offset utility classes if present
            header.classList.remove('relative','bottom-[30px]','left-[-24px]');
            // ensure no inline offsets
            header.style.left = '0';
            header.style.right = '0';
            header.style.bottom = '0';
        }
        // actions: ensure positioned relative to header (not fixed) and store prev classes
        if (actions) {
            actions.dataset.prevClass = actions.className || '';
            actions.classList.remove('fixed');
            if (!actions.classList.contains('absolute')) actions.classList.add('absolute');
        }
    } else {
        wrapper.classList.remove('maximized');
        wrapper.classList.remove('left-0','top-0','right-0','bottom-0','w-full','h-full','border-2');
        wrapper.classList.add('w-[350px]','h-[420px]');
        wrapper.style.left = wrapper.dataset.prevLeft || '';
        wrapper.style.top = wrapper.dataset.prevTop || '';
        // restore header classes/styles
        if (header) {
            if (header.dataset.prevClass !== undefined) header.className = header.dataset.prevClass;
            if (header.dataset.prevStyle !== undefined) header.setAttribute('style', header.dataset.prevStyle);
            else {
                header.style.left = '';
                header.style.right = '';
                header.style.bottom = '';
            }
            delete header.dataset.prevClass;
            delete header.dataset.prevStyle;
        }
        // restore actions class
        if (actions && actions.dataset.prevClass !== undefined) {
            actions.className = actions.dataset.prevClass;
            delete actions.dataset.prevClass;
        }
        // restore m-auto if it was present before maximize
        if (wrapper.dataset.hadAuto === '1') wrapper.classList.add('m-auto');
        delete wrapper.dataset.hadAuto;
    }
}

function toggleMinimize() {
    // Toggle a 'minimized' state by collapsing to header height
    if (!wrapper.classList.contains('minimized')) {
        const headerHeight = Math.ceil(header.getBoundingClientRect().height);
        wrapper.dataset.prevHeight = wrapper.style.height || '';
        wrapper.style.height = headerHeight + 'px';
        wrapper.classList.add('overflow-hidden','minimized');
    } else {
        wrapper.classList.remove('minimized','overflow-hidden');
        // restore height (or default Tailwind height)
        wrapper.style.height = wrapper.dataset.prevHeight || '';
        if (!wrapper.style.height) {
            wrapper.classList.add('h-[420px]');
        }
    }
}

function closeWindow() {
    // store current inline position so reopening restores it
    wrapper.dataset.savedLeft = wrapper.style.left || '';
    wrapper.dataset.savedTop = wrapper.style.top || '';
    wrapper.classList.add('hidden');
}

function openWindow() {
    wrapper.classList.remove('hidden');
    // restore saved position if any, else clear inline styles so CSS centering applies
    if (wrapper.dataset.savedLeft !== undefined) {
        if (wrapper.dataset.savedLeft) wrapper.style.left = wrapper.dataset.savedLeft;
        else wrapper.style.left = '';
        delete wrapper.dataset.savedLeft;
    }
    if (wrapper.dataset.savedTop !== undefined) {
        if (wrapper.dataset.savedTop) wrapper.style.top = wrapper.dataset.savedTop;
        else wrapper.style.top = '';
        delete wrapper.dataset.savedTop;
    }
    // ensure actions are visible (in case they were modified)
    if (actions && actions.dataset.prevClass !== undefined) {
        // if prevClass exists, we've likely been maximized before; leave as-is
    } else if (actions) {
        actions.classList.remove('hidden');
    }
}

header.addEventListener('mousedown', (e) => {
    // ignore drag when maximized
    if (wrapper.classList.contains('maximized')) return;
    isMouseDown = true;
    offsetX = wrapper.offsetLeft - e.clientX;
    offsetY = wrapper.offsetTop - e.clientY;
});

document.addEventListener('mousemove', (e) => {
    if (!isMouseDown) return;
    e.preventDefault();
    let left = e.clientX + offsetX;
    let top = e.clientY + offsetY;
    wrapper.classList.remove('left-0','right-0','bottom-0','top-0');
    wrapper.style.left = left + 'px';
    wrapper.style.top = top + 'px';
});

document.addEventListener('mouseup', () => {
    isMouseDown = false;
});
