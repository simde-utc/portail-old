<div class="part">
  <h1>Titre</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae est at massa aliquam vulputate ac non velit. Curabitur vulputate volutpat porttitor. Cras sit amet ipsum at augue faucibus tristique blandit sit amet turpis. Suspendisse eros turpis, sodales laoreet volutpat a, suscipit eu felis. Donec ac consectetur tellus. Curabitur non ipsum felis, sed dignissim magna. Donec blandit dui id nisl mollis adipiscing malesuada ipsum mattis. Nulla vitae semper erat. Sed magna magna, varius quis ultrices non, lobortis in elit.</p>
  <h2>Section</h2>
  <p>
    Ut egestas odio et massa pharetra ut condimentum odio lacinia. Aliquam nec urna turpis, ut pretium justo. Aliquam venenatis fringilla elementum. Suspendisse id viverra tortor. Mauris metus velit, sollicitudin imperdiet molestie non, lobortis ac ipsum. Aliquam diam enim, consectetur quis mattis nec, volutpat in nunc. Integer pulvinar nisi vel tellus laoreet scelerisque. Donec hendrerit adipiscing sem sit amet pellentesque. Cras a lacus et odio congue volutpat. Etiam erat felis, euismod nec fringilla non, imperdiet quis quam. Ut sit amet mi non ipsum egestas congue. Fusce ultricies ante in arcu pellentesque vestibulum. Curabitur convallis eros at mi laoreet porta. Mauris fermentum justo eu magna eleifend lacinia. Mauris ac massa enim, sed congue sem. Sed ullamcorper tempor orci, vel bibendum orci interdum a.
  </p>
  <h2>Section</h2>
  <p>
    Nullam diam elit, malesuada vitae rhoncus id, bibendum vitae dui. Mauris est libero, tincidunt placerat volutpat eu, laoreet a tellus. Etiam aliquam massa at mi vehicula elementum. Phasellus vestibulum orci at nisl cursus viverra. Cras interdum lobortis sapien nec suscipit. Integer enim augue, rhoncus ut eleifend a, ornare adipiscing sapien. Proin pharetra nisl eget lacus mattis et iaculis elit varius. Morbi erat mi, ullamcorper vitae rhoncus vitae, pellentesque ut arcu.
  </p>
  <h2>Section</h2>
  <p>
    Donec eget adipiscing magna. Donec laoreet euismod vestibulum. Donec ut lacus at nunc tincidunt ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus posuere placerat orci et posuere. Sed gravida placerat lectus eget commodo. Nunc a est sapien, sit amet lobortis tortor. Nulla et tristique odio. Cras quis augue mi, id rutrum risus.
  </p>
  <h2>Section</h2>
  <p>
    Proin cursus nunc ac magna iaculis ut ultrices felis tincidunt. Sed placerat tempor feugiat. In hac habitasse platea dictumst. Aliquam erat volutpat. Etiam tincidunt lorem id felis cursus scelerisque. Aenean fermentum sapien lacus, sit amet ultricies magna. Etiam dictum tempus metus non condimentum. Integer vel risus lorem. Etiam ut ipsum erat, ac imperdiet orci. Donec ac massa nisi.
  </p>
  <div class="well">
    <form method="post" action="<?php echo url_for('asso_charte_post') ?>">
      <label for="check">En retappant votre login <em><?php echo $sf_user->getUsername() ?></em> dans la case ci-contre, vous acceptez les conditions ci-dessous
        et devenez responsable des ressources informatiques mises à disposition par le BDE et le SiMDE pour l'association <em><?php echo $asso->getLogin() ?></em>.</label>
      <input type="text" name="check" />
      <input type="hidden" name="asso_id" value="<?php echo $asso->getId() ?>" />
      <input type="submit" class="btn btn-primary" value="Je signe" />
    </form>
  </div>
</div>