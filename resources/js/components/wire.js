export function Wire($wire, data) {
    return {
        formType: $wire.entangle('formType'),
        init() {
            Alpine.effect(() => {
            });
        },
    }
}

export default Wire


