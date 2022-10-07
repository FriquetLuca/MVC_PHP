export class HTMLHelper {
    static newElement(tagName, ...classes) {
        const eventSection = document.createElement(tagName);
        classes.forEach(c => eventSection.classList.add(c));
        return eventSection;
    }
}