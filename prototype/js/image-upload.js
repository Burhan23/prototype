filegambar.onchange = evt => {
    const [file] = filegambar.files
    if (file) {
      gambar.src = URL.createObjectURL(file)
    }
  }