(function( $ ) {
    // Update primary color
    wp.customize( 'minimalist_primary_color', function( value ) {
        value.bind( function( to ) {
            const style = document.getElementById('minimalist-customize-colors');
            if (!style) {
                const newStyle = document.createElement('style');
                newStyle.id = 'minimalist-customize-colors';
                document.head.appendChild(newStyle);
            }
            document.getElementById('minimalist-customize-colors').textContent = 
                ':root { --primary-color: ' + to + '; }';
        });
    });

    // Update accent color
    wp.customize( 'minimalist_accent_color', function( value ) {
        value.bind( function( to ) {
            const style = document.getElementById('minimalist-customize-colors');
            if (!style) {
                const newStyle = document.createElement('style');
                newStyle.id = 'minimalist-customize-colors';
                document.head.appendChild(newStyle);
            }
            document.getElementById('minimalist-customize-colors').textContent += 
                ':root { --accent-color: ' + to + '; }';
        });
    });
})( jQuery );