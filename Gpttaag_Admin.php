def save_product_tags(self):
    products = wc_get_products()
    if not products:
        return

    for product in products:
        title = product['name']
        description = product['description']
        image = product['image']

        # Call the GPT-3 API to generate tags for the product
        try:
            tags = gpt3.generate_tags(title, description)
        except Exception as e:
            self.log_error('Error generating tags for product ID {0}: {1}'.format(product['id'], str(e)))
            continue

        # Add the tags to the product
        existing_tags = product['tags']
        new_tags = list(set(tags) - set(existing_tags))
        if new_tags:
            product['tags'] = existing_tags + new_tags

            # Save the updated product
            try:
                wc_update_product(product)
            except Exception as e:
                self.log_error('Error saving tags for product ID {0}: {1}'.format(product['id'], str(e)))
                continue
