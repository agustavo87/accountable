import KeyPressedOnMoneyInput from "./keyPressedOnMoneyInput";

export default function (input, locale, event, component) {
    const onAmount = new KeyPressedOnMoneyInput(
        input,
        locale,
        event
    );

    if (onAmount.aFunctionalKeyIsPressed) {
        if (onAmount.isErasingAThousand) {
            // we don't want to erase thousands groups, just jump over them.
            onAmount.jumpOnePositionBack();
            return;
        }
        // After the default event handler has made effect.
        component.$nextTick(() => {
            // new instance with previous event, but updated imput
            const _onAmount = new KeyPressedOnMoneyInput(
                input,
                locale,
                event
            );
            _onAmount.value = !_onAmount.empty
                ? component.format(_onAmount.toStandardDecimal(_onAmount.initValue))
                : "";
            component.standardDecimalAmount = _onAmount.toStandardDecimal(
                _onAmount.value
            );
            if (_onAmount.pressed("Backspace")) {
                _onAmount.cursor =
                    _onAmount.calculateCursorPositionAfterBackspace();
                return;
            }
            _onAmount.cursor = _onAmount.cursor;
        });
        return;
    }

    onAmount.preventDefault();

    if (onAmount.aValidNumericKeyIsPressed) {
        if (onAmount.aDecimalIsPressed) {
            if (onAmount.aDecimalIsPresent) return;
            onAmount.value =
                component.format(onAmount.toStandardDecimal(onAmount.firstSegment)) +
                onAmount.key +
                onAmount.removeThousands(onAmount.lastSegment);
            if (onAmount.lastSegment) {
                // if there's something at the right of the decimal sign.
                component.standardDecimalAmount = onAmount.toStandardDecimal(
                    onAmount.value
                );
            }
            onAmount.cursor++;
            return;
        }

        if (onAmount.cursorIsOnFractionSide) {
            onAmount.value = onAmount.compound;
            // only save if the fractional part is inbound of scale
            if (
                onAmount.partsOf(onAmount.value).fractional.length <= component.scale
            ) {
                component.standardDecimalAmount = onAmount.toStandardDecimal(
                    onAmount.value
                );
            }
            onAmount.cursor++;
            return;
        }

        component.reformatInput(onAmount);
        component.standardDecimalAmount = onAmount.toStandardDecimal(onAmount.value);
    }
}
