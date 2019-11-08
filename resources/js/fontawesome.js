import { library, dom } from '@fortawesome/fontawesome-svg-core';
import {
    fas,
    faCaretUp,
    faStar,
    faCaretDown,
    faCheck,
} from '@fortawesome/free-solid-svg-icons';

library.add(fas, faCaretUp, faStar, faCaretDown, faCheck);

// Kicks off the process of finding <i> tags and replacing with <svg>
dom.watch();
