filegambar.onchange = evt => {
    const [file] = filegambar.files
    if (file) {
      gambar.src = URL.createObjectURL(file)
    }
  }

filegambarku.onchange = evt => {
  const [file] = filegambarku.files
  if (file) {
    gambarnya.src = URL.createObjectURL(file)
  }
}