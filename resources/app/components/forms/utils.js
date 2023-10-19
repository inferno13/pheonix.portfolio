export const mapSchemaToForm = (schema) => {
  const initialVal = { id: '' }
  return schema.reduce((acc, cur) => {
    Object.keys(cur.fields).forEach((key) => {
      acc[key] = cur.fields[key].value
    })
    return acc
  }, initialVal)
}

export const matchWithSchema = (data, schema) => {
  schema.forEach((group) => {
    Object.keys(group.fields).forEach((key) => {
      if (Object.prototype.hasOwnProperty.call(data, key) && group.fields[key].type === 'switch') {
        data[key] = !!data[key]
      }
    })
  })
}
