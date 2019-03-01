<div class="container">

  <h2>Add new organisation...</h2>

  <form name = "new_organisation" method="POST" action = "all_organisations.php?action=add">
    <div id="form_container">

      <div class="form-row">
        <div class="form-group col">
        <label for ="account_name">Organisation name:</label>
        <input name="accountname" class="form-control" id="accountname" type="text" required>
        </div>

        <div class="form-group col">
        <label for ="accountcode">Account code:</label>
        <input name="accountcode" class="form-control" id="accountcode" type="text" required>
        </div>
      </div>

      <div class="form-row">
          <div class="form-group col">
          <label for ="address">Street address:</label>
          <input name="address" class="form-control" id="address" type="text" required>
          </div>
      </div>

      <div class="form-row">
        <div class="form-group col">
          <label for ="city">City:</label>
          <input name="city" class="form-control" id="city" type="text" required>
        </div>
        <div class="form-group col">
          <label for ="postcode">Postcode:</label>
          <input name="postcode" class="form-control" id="postcode" type="text" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <label for ="website">Website:</label>
          <input name="website" class="form-control" id="email" type="text" required>
        </div>
        <div class="form-group col">
          <label for ="phone">Phone:</label>
          <input name="phone" class="form-control" id="phone" type="number" required>
        </div>
      </div>

      <input type="submit" class="btn btn-primary" id="button">

    </form>
</div>
